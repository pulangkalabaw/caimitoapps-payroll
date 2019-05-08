<?php
namespace App\Traits;

use Carbon\Carbon;

// Models
use App\UserCompensation;
use App\UserCompensationHistory;

trait CompensationHistoryTrait
{
    public function storeHistory($batch_comp){

        //
        $user_compensation_history = new UserCompensationHistory();
        $user_compensation = new UserCompensation();

        $date = Carbon::now()->toDateString();
        $batch_id = $date.rand(1111,9999);

        $compensations = $user_compensation->where('user_id', $batch_comp['user_id'])->get();

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

        // foreach($batch_comp as $emp){
        //
        //     $data[] = [
        //         'batch_id' => $batch_id,
        //         'user_id' => $emp['user_id'],
        //         'compensation_id' => $emp['compensation_id'],
        //         'user_compensation_id' => $emp['user_compensation_id'],
        //         'amount' => $emp['amount'],
        //         'taxable' => $emp['taxable'],
        //         'type' => $emp['type'],
        //         'date_start' => $emp['date_start']
        //     ];
        //
        //     $compensations = $user_compensation->where('user_id', $emp['user_id'])->get();
        //
        //     if(!empty($compensations)){
        //
        //         foreach($compensations as $user_comp){
        //             $data[] = [
        //                 'batch_id' => $batch_id,
        //                 'user_id' => $user_comp['user_id'],
        //                 'compensation_id' => $user_comp['compensation_id'],
        //                 'user_compensation_id' => $user_comp['user_compensation_id'],
        //                 'amount' => $user_comp['amount'],
        //                 'taxable' => $user_comp['taxable'],
        //                 'type' => $user_comp['type'],
        //                 'date_start' => $user_comp['date_start']
        //             ];
        //         }
        //
        //     }
        //
        // }

    }

    public function storeMultiHistory($user_id) {
        $user_compensation_history = new UserCompensationHistory();
        $user_compensation = new UserCompensation();

        $date = Carbon::now()->toDateString();
        $batch_id = $date.rand(1111,9999);

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

}
