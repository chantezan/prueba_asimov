<?php

namespace App;
use App\Schedule;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['date','name','last_name','phone','email'];

    public function save(array $options = []) {
        if(!$this->validate()){
          return false;
        }
        return parent::save($options);
    }

    public function validate() {

      $end_hour = (new DateTime($this->date))->modify('+1 hours')->format('Y-m-d G:i');
      $previous_hour = (new DateTime($this->date))->modify('-1 hours')->format('Y-m-d G:i');
      $books_aux = $this->where([['date','<',$end_hour],['date','>',$previous_hour]])->count();
      if($books_aux > 0 ) {
        if($this->id != null){
          if($books_aux > 1){
            return false;
          }
        } else {
          return false;
        }
      }
      $day = (new DateTime($this->date))->format('w');
      $hour_date_start = (new DateTime($this->date))->format('G:i');
      $hour_date_end = (new DateTime($this->date))->modify('+1 hours')->format('G:i');
      $sche_aux = Schedule::whereDate('start_date','<=',$this->date)->whereDate('end_date','>=',$this->date)
          ->whereTime('end_hour','>=',$hour_date_end)->whereTime('start_hour','<=',$hour_date_start)
          ->where('day',$day)->count();
      if($sche_aux == 0) {
        return false;
      }
      return true;
    }
}
