@extends('layouts.app')

@section('title', 'تم الإرسال - NHBS')

@section('content')
<main class="pt-32 pb-20 px-4 md:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-[#16214d] border border-white/10 rounded-xl p-container-padding shadow-2xl text-center">

            <span class="material-symbols-outlined text-6xl mb-4 block" style="color:#bac3ff;">check_circle</span>
            <h2 class="text-3xl font-bold text-white mb-3">تم إرسال طلبك بنجاح!</h2>
            <p class="text-on-surface-variant mb-8">شكراً لتقديمك، سيتم التواصل معك قريباً.</p>

            <a href="{{ route('applicant.form') }}"
                class="inline-block bg-primary-container hover:bg-opacity-90 text-white px-10 py-3 rounded-full font-headline-md transition-all duration-300 shadow-lg">
                تقديم طلب جديد
            </a>

            <div class="mt-10 pt-6 border-t border-white/10 space-y-2">
                <p class="font-bold text-white">للاستفسارات والمعلومات</p>
                <p class="text-on-surface-variant">م. رامي حسن - قسم تطوير الاعمال</p>
                <div class="flex flex-col items-center gap-2 mt-2">
                    <div class="flex items-center gap-2" dir="ltr">
                        <span class="material-symbols-outlined text-sm">phone_iphone</span>
                        <span class="text-on-surface-variant">0501733271</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">mail</span>
                        <span class="text-on-surface-variant">eng.ramy@nhbs.sa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
