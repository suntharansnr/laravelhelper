<?php
namespace App\Notifications;
use App\City;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewCity extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
     /**
      * @var User
      */
     protected $added_by_user;

     /**
      * @var City
      */
     protected $city;

    public function __construct(User $added_by_user, City $city)
    {
      $this->added_by_user = $added_by_user;
      $this->city = $city;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
//        return ['database','mail'];
          return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//                    ->line('The introduction to the notification.')
//                    ->action('Notification Action', url('/'))
//                    ->line('Thank you for using our application!');
//    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
     public function toDatabase($notifiable)
     {
         return [
             'added_user_id' => $this->added_by_user->id,
             'added_user_name' => $this->added_by_user->name,
             'added_user_img' => $this->added_by_user->profile_photo_path,
             'city_id' => $this->city->id,
             'slug' => $this->city->slug,
         ];
     }

    public function toArray($notifiable)
    {
        return [
          'id' => $this->id,
         'read_at' => null,
         'data' => [
             'added_user_id' => $this->added_by_user->id,
             'added_user_name' => $this->added_by_user->name,
             'added_user_img' => $this->added_by_user->profile_photo_path,
             'city_id' => $this->city->id,
             'slug' => $this->city->slug,
         ],
        ];
    }
}
