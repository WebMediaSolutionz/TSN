<?php
	class WebhookCtrl extends ActionCtrl {
		public static function process_request () {
            http_response_code(200);

			$input = file_get_contents('php://input');
            $event = json_decode($input);

            \Stripe\Stripe::setApiKey( STRIPE_SECRET_KEY );

            // TODO: for security, to make sure stripe really sent that event
            // $event = \Stripe\Event::retrieve($event->id);

            $stripe_id = $event->data->object->customer;
            $user = User::find_by_stripe_id($stripe_id); // get customer with that stripe id
            

            switch($event->type) {
                case 'invoice.payment_succeeded'    :   $plan = $event->data->object->lines->data[0]->plan->id;
                
                                                        if ( $plan === 'gold' ) {
                                                            $user->membership_end_date = Utils::mysql_datetime('+3 day');
                                                        } else if ( $plan === 'silver' ) {
                                                            $user->membership_end_date = Utils::mysql_datetime('+1 month');
                                                        } else if ( $plan === 'bronze' ) {
                                                            $user->membership_end_date = Utils::mysql_datetime('+1 year');
                                                        }

                                                        $user->reactivate();

                                                        break;

                case 'invoice.payment_failed'       :   $email_subject = 'your payment has been declined';
                                                        $email_message = 'your payment has been declined';

                                                        Utils::sendmail( $user, $email_subject, $email_message );

                                                        $user->deactivate();

                                                        break;
            }

            header( 'Content-type: application/json' );
            exit( json_encode( $user ) );
		}
	}
?>