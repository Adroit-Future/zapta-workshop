<?php

namespace App\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe\Stripe;

class StripeWebhookController extends Controller {

    public function handle(Request $request)
    {
        // Stripe Webhook Secret
        $endpoint_secret = config('services.stripe.webhook_secret');
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;
        try {
          // if the scripe secret and the env secret is matched or not
          $event = \Stripe\Webhook::constructEvent(
            $payload, $sig_header, $endpoint_secret
          );
        } catch(\UnexpectedValueException $e) {
          // Invalid payload
          http_response_code(400);
          exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
          // Invalid signature
          http_response_code(400);
          exit();
        }

        // Handle the event
        switch ($event->type) {
          // If payment is succeeded
          case 'invoice.payment_succeeded':
            info("payment success",[$event]);
            $account = $this->handleInvoicePaymentSucceeded($event);
          break;
          case 'invoice.payment_failed':
            info("payment failed",[$event]);
            $account = $this->handleInvoicePaymentFailed($event);
            break;
          case 'customer.subscription.deleted':
            info("subscription cancelled",[$event]);
              $account = $this->handleCustomerSubscriptionCanceled($event);
              break;
          default:
            echo 'Received unknown event type ' . $event->type;
            break;
        }

        http_response_code(200);
    }

    private function handleInvoicePaymentSucceeded($payload){
            $subscription= $payload->data->object;
            $period_start= $subscription->period_end;
            $customer=$subscription->customer;
            $subscription_id=$subscription->subscription;
            $subscription_end=date('Y/m/d H:i:s', $period_start);
          if(!empty($subscription_id) && !empty($customer) && $subscription->status=='paid')
          {
              $user=User::where('stripe_customer_id',$customer)->first();
              if($user){
                $user->update(['expire_untill'=>$subscription_end]);
                $subscription=Subscription::where('user_id',$user->id)->orderBy('id','DESC')->first();
                if($subscription){
                  $subscription->update(['updated_at'=>now(),'ends_at'=>$subscription_end]);
                }
              }
          }
          http_response_code(200);
    }

    private function handleInvoicePaymentFailed($payload){
      $subscription= $payload->data->object;
      $period_start= $subscription->period_end;
      $customer=$subscription->customer;
      $subscription_id=$subscription->subscription;
      $subscription_end=date('Y/m/d H:i:s', $period_start);

      if(!empty($subscription_id)){
        $checkSubscription=Subscription::where('subscription',$subscription_id)->firstorfail();
        if($checkSubscription){
          $user=User::where('stripe_customer_id',$customer)->firstorfail();
          $user->update(['expire_untill'=>now()]);
          $checkSubscription->update(['ends_at'=>now()]);
        }
      }
      http_response_code(200);
   }

   private function handleCustomerSubscriptionCanceled($payload){
        $subscription= $payload->data->object;
        if($subscription->status=='canceled'){
          $period_ended_at= $subscription->ended_at;
          $customer=$subscription->customer;
          if(empty($period_ended_at)) $subscription_end = date('Y/m/d H:i:s',$subscription->current_period_end);
          else $subscription_end =date('Y/m/d H:i:s',$subscription->ended_at);

          $subscription_id=$subscription->id;
          info("sub",[$subscription_id,$customer]);
          if(!empty($subscription_id) && !empty($customer))
          {
            $user=User::where('stripe_customer_id',$customer)->firstorfail();
            $user->update(['expire_untill'=>$subscription_end]);
            info("user",[$user]);
            Subscription::where('subscription',$subscription_id)->update(['canceled_at'=>date('Y/m/d H:i:s',$subscription->canceled_at),'updated_at'=>now(),'ends_at'=>$subscription_end]);
          }
        }
    http_response_code(200);
 }
}
