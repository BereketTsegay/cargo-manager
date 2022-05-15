<?php

namespace App\Models;

use Illuminate\Http\Request;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;
use Spatie\Multitenancy\TenantFinder\TenantFinder;
use App\Models\CargoTenant;

class CargoTenantFinder extends TenantFinder
{
    use UsesTenantModel;

    public function findForRequest(Request $request):?CargoTenant
    {
        // $host = $request->getHost();

        return $this->getTenantModel()::where('user_id',$request->header('owner_id'))->first();
    }
}
