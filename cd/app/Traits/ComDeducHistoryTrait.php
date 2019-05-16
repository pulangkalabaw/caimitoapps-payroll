<?php
namespace App\Traits;

use Carbon\Carbon;

// Models


trait ComDeducHistoryTrait
{
  public function storeMultiCompHistory($user_id) {
      $user_compensation_history = new UserCompensationHistory();
      $user_compensation = new UserCompensation();

      $date = Carbon::now()->toDateString();
      $batch_id = $date.'_'.rand(1111,9999);

      $compensations = $user_compensation->where('user_id', $user_id)->get();

      if(count($compensations) != 0){
          foreach($compensations as $user_comp){
              $data[] = [
                  'batch_id' => $batch_id,
                  'user_id' => $user_comp['user_id'],
                  'compensation_id' => $user_comp['compensation_id'],
                  'user_compensation_id' => $user_comp['user_compensation_id'],
                  'amount' => $user_comp['amount'],
                  'taxable' => $user_comp['taxable'],
                  'type' => $user_comp['type'],
                  'date_start' => $user_comp['date_start']
              ];
          }

          $user_compensation_history->insert($data);
      }

  }

  public function storeMultiCompHistory($user_id){

  }

}
