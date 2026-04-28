<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function create()
    {
        return view('applicant.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone'            => 'required|string|max:20',
            'education'        => 'required|string|max:255',
            'birth_date'       => 'nullable|date',
            'city'             => 'required|string|max:255',
            'position_applied' => 'required|string|max:255',
            'current_position' => 'required|string|max:255',
            'experience'       => 'nullable|string',
            'etimad_knowledge' => 'required|in:0,1',
            'cv_path'          => 'required|file|mimes:pdf,doc,docx|max:5120',
            'portfolio_path'   => 'nullable|file|mimes:pdf,doc,docx,zip|max:10240',
        ], [
            'full_name.required'        => 'الاسم الكامل مطلوب.',
            'email.required'            => 'البريد الإلكتروني مطلوب.',
            'email.email'               => 'صيغة البريد الإلكتروني غير صحيحة.',
            'phone.required'            => 'رقم الجوال مطلوب.',
            'education.required'        => 'المؤهل العلمي مطلوب.',
            'city.required'             => 'المدينة مطلوبة.',
            'position_applied.required' => 'الوظيفة المقدم إليها مطلوبة.',
            'current_position.required' => 'الوظيفة الحالية مطلوبة.',
            'etimad_knowledge.required' => 'يرجى الإجابة على سؤال منصة اعتماد.',
            'cv_path.required'          => 'السيرة الذاتية مطلوبة.',
            'cv_path.mimes'             => 'صيغة السيرة الذاتية يجب أن تكون PDF أو DOC.',
            'cv_path.max'               => 'حجم السيرة الذاتية يجب ألا يتجاوز 5 ميجابايت.',
            'portfolio_path.mimes'      => 'صيغة ملف الأعمال يجب أن تكون PDF أو DOC أو ZIP.',
            'portfolio_path.max'        => 'حجم ملف الأعمال يجب ألا يتجاوز 10 ميجابايت.',
        ]);

        if ($request->hasFile('cv_path')) {
            $validated['cv_path'] = $request->file('cv_path')->store('cvs', 'public');
        }

        if ($request->hasFile('portfolio_path')) {
            $validated['portfolio_path'] = $request->file('portfolio_path')->store('portfolios', 'public');
        }

        Applicant::create($validated);

        return redirect()->route('applicant.success');
    }

    public function success()
    {
        return view('applicant.success');
    }
}
