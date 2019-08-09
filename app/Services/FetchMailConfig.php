<?php

namespace App\Services;

use DB;

class FetchMailConfig
{
    public function get_mail_credentials($app_name)
    {
        return DB::connection('ipc_central')
            ->table('notification_system_email as nse')
            ->leftJoin('notification_emails as ne', 'ne.id', '=', 'nse.notif_email_id')
            ->leftJoin('system_tab as st', 'st.id', '=', 'nse.system_id')
            ->where('st.system', $app_name)
            ->first();
    }
}