<?php

namespace App\Exports;

use App\Models\ContactRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactRequestsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ContactRequest::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'full_name' => $item->full_name,
                'email' => $item->email,
                'phone' => $item->phone,
                'how_heard' => $item->how_heard,
                'services_selected' => is_array($item->services_selected) ? implode(', ', $item->services_selected) : $item->services_selected,
                'project_details' => $item->project_details,
                'gclid' => $item->gclid,
                'client_id' => $item->client_id,
                'referrer' => $item->referrer,
                'page_url' => $item->page_url,
                'ip_address' => $item->ip_address,
                'user_agent' => $item->user_agent,
                'created_at' => $item->created_at,
            ];
        });
    }


    public function headings(): array
    {
        return [
            'ID',
            'Full Name',
            'Email',
            'Phone',
            'How Heard',
            'Services',
            'Project Details',
            'GCLID',
            'Client ID',
            'Referrer',
            'Page URL',
            'IP',
            'User Agent',
            'Created At'
        ];
    }
}
