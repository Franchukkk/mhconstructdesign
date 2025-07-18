<?php

namespace App\Exports;

use App\Models\ContactRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactRequestsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ContactRequest::select(
            'id',
            'full_name',
            'email',
            'phone',
            'how_heard',
            'services_selected',
            'project_details',
            'gclid',
            'client_id',
            'referrer',
            'page_url',
            'ip_address',
            'user_agent',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Full Name', 'Email', 'Phone', 'How Heard', 'Services', 'Project Details',
            'GCLID', 'Client ID', 'Referrer', 'Page URL', 'IP', 'User Agent', 'Created At'
        ];
    }
}
