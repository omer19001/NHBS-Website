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
        // Handle PHP-level upload errors (e.g. file exceeds upload_max_filesize in php.ini)
        foreach (['cv_path', 'portfolio_path'] as $field) {
            if ($request->hasFile($field) && $request->file($field)->getError() !== UPLOAD_ERR_OK) {
                return redirect()->route('applicant.form')
                    ->withInput()
                    ->withErrors([$field => 'حدث خطأ أثناء رفع الملف. يرجى التأكد من أن حجم الملف لا يتجاوز الحد المسموح به.']);
            }
        }

        // Handle case where POST data is missing due to post_max_size being exceeded
        if (empty($request->post()) && $request->server('CONTENT_LENGTH') > 0) {
            return redirect()->route('applicant.form')
                ->withErrors(['cv_path' => 'حجم الملف المرفوع أكبر من المسموح به. يرجى تقليل حجم الملف والمحاولة مجدداً.']);
        }

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

        try {
            if ($request->hasFile('cv_path')) {
                $validated['cv_path'] = $request->file('cv_path')->store('cvs', 'public');
            }

            if ($request->hasFile('portfolio_path')) {
                $validated['portfolio_path'] = $request->file('portfolio_path')->store('portfolios', 'public');
            }

            Applicant::create($validated);
        } catch (\Exception $e) {
            return redirect()->route('applicant.form')
                ->withInput()
                ->withErrors(['cv_path' => 'حدث خطأ أثناء حفظ الملف. يرجى المحاولة مرة أخرى.']);
        }

        return redirect()->route('applicant.success');
    }

    public function success()
    {
        return view('applicant.success');
    }
}
