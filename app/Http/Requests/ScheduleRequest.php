<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'class_room_id' => 'required|exists:class_rooms,id',
            'teacher_subject_id' => 'required|exists:teacher_subjects,id',
            'day_of_week' => 'required|in:monday,tuesday,wednesday,thursday,friday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Cek apakah ada jadwal yang bentrok
            $existingSchedule = \App\Models\Schedule::where('day_of_week', $this->day_of_week)
                ->where('start_time', $this->start_time)
                ->exists();

            if ($existingSchedule) {
                $validator->errors()->add('start_time', 'Jadwal dengan waktu dan hari yang sama sudah ada.');
            }
        });
    }
}
