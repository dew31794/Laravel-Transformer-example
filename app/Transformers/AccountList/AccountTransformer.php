<?php

namespace App\Transformers\AccountList;

use League\Fractal\TransformerAbstract;
use App\Models\Account;
use Carbon\Carbon;

class AccountTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Account $account)
    {
        $params = [
            // 'id'           => $account->id,
            'account'       => $account->account,
            'password'      => $account->password,
            'staff_id'      => $account->staff->name,
            'status'        => $account->status,
            'remark'        => $account->remark,
            // 'created_at'   => $account->created_at,
            // 'updated_at'   => $account->updated_at,
        ];
        
        return $params;
    }
}
