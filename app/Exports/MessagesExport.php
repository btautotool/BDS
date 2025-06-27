<?php

namespace App\Exports;

use App\Message;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MessagesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Message::select('name', 'email', 'phone', 'time', 'message', 'created_at')
            ->where('agent_id', Auth::id())
            ->latest()
            ->get()
            ->map(function($message) {
                return [
                    'name' => $message->name,
                    'email' => $message->email, 
                    'phone' => $message->phone,
                    'time' => Carbon::parse($message->time)->format('H:i d/m/Y'),
                    'message' => strip_tags($message->message),
                    'created_at' => $message->created_at->format('d/m/Y')
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tên người yêu cầu',
            'Email',
            'Số điện thoại', 
            'Thời gian',
            'Ghi chú',
            'Ngày tạo'
        ];
    }
}
