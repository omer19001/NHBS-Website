@extends('layouts.app')

@section('title', 'نموذج التقديم الوظيفي - NHBS')

@section('content')
<main class="pt-32 pb-20 px-4 md:px-8">
    <div class="max-w-4xl mx-auto">

        {{-- Hero --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">تقدم لوظيفتك المناسبة</h1>
            <p class="font-body-lg text-on-surface-variant max-w-2xl mx-auto">
                نحن نبحث دائمًا عن المبدعين والمتحمسين للمساهمة في رحلتنا نحو التميز الرقمي.
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-[#16214d] border border-white/10 rounded-xl p-container-padding shadow-2xl">

            {{-- Validation errors --}}
            @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-900/40 border border-red-500/40 text-red-300 text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form action="{{ route('applicant.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- الاسم الكامل --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">الاسم الكامل *</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}"
                        class="w-full bg-[#1c2a5e] border border-white/20 rounded-full py-3 px-6 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"/>
                </div>

                {{-- الايميل --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">الايميل *</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full bg-[#1c2a5e] border border-white/20 rounded-full py-3 px-6 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"/>
                </div>

                {{-- رقم الجوال --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">رقم الجوال *</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" dir="ltr"
                        class="w-full bg-[#1c2a5e] border border-white/20 rounded-full py-3 px-6 text-white text-left focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"/>
                </div>

                {{-- المؤهل العلمي --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">المؤهل العلمي *</label>
                    <input type="text" name="education" value="{{ old('education') }}"
                        class="w-full bg-[#1c2a5e] border border-white/20 rounded-full py-3 px-6 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"/>
                </div>

                {{-- تاريخ الميلاد --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">تاريخ الميلاد</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}"
                        class="w-full bg-[#1c2a5e] border border-white/20 rounded-full py-3 px-6 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"/>
                </div>

                {{-- المدينة --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">المدينة *</label>
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="w-full bg-[#1c2a5e] border border-white/20 rounded-full py-3 px-6 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"/>
                </div>

                {{-- الوظيفة المقدم إليها --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">الوظيفة المقدم إليها *</label>
                    <select name="position_applied"
                        class="w-full bg-[#1c2a5e] border border-white/20 rounded-full py-3 px-6 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all appearance-none">
                        <option value="" disabled {{ old('position_applied') ? '' : 'selected' }}>اختر الوظيفة المراد التقدم لها</option>
                        @php
                            $positions = [
                                'معد عروض فنية لخدمات الأعمال',
                                'معد عروض فنية في تصميم وتنفيذ الفعاليات',
                                'معد عروض فنية في التدريب الصحي و الفني',
                                'معد عروض فنية في الاستشارات الإدارية',
                                'معد عروض فنية في الخدمات البيئية',
                                'معد عروض فنية في التقنية والمعلومات',
                                'مصمم جرافيك ( عروض تقديمية )',
                                'مصمم جرافيك 3D',
                            ];
                        @endphp
                        @foreach($positions as $pos)
                            <option value="{{ $pos }}" {{ old('position_applied') == $pos ? 'selected' : '' }}>{{ $pos }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- الوظيفة الحالية --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">الوظيفة الحالية *</label>
                    <input type="text" name="current_position" value="{{ old('current_position') }}"
                        class="w-full bg-[#1c2a5e] border border-white/20 rounded-full py-3 px-6 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"/>
                </div>

                {{-- الراتب الحالي --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">الراتب الحالي</label>
                    <input type="text" name="current_salary" value="{{ old('current_salary') }}"
                        placeholder="مثال: 8000 ريال"
                        class="w-full bg-[#1c2a5e] border border-white/20 rounded-full py-3 px-6 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all"/>
                </div>

                {{-- الخبرات السابقة --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">الخبرات السابقة مع المدة لكل خبرة</label>
                    <textarea name="experience" rows="4"
                        placeholder="اذكر خبراتك السابقة مع المدة الزمنية لكل منها..."
                        class="w-full bg-[#1c2a5e] border border-white/20 rounded-3xl py-3 px-6 text-white focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all">{{ old('experience') }}</textarea>
                </div>

                {{-- منصة اعتماد --}}
                <div class="space-y-2">
                    <label class="block font-label-md text-white">هل لديك معرفة بمنصة اعتماد *</label>
                    <div class="flex items-center gap-6 mt-2">
                        <div class="flex items-center gap-2">
                            <input type="radio" id="etimad-yes" name="etimad_knowledge" value="1"
                                {{ old('etimad_knowledge') == '1' ? 'checked' : '' }}
                                class="w-5 h-5 rounded bg-[#1c2a5e] border-white/20 text-primary focus:ring-primary"/>
                            <label class="text-on-surface-variant" for="etimad-yes">نعم</label>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" id="etimad-no" name="etimad_knowledge" value="0"
                                {{ old('etimad_knowledge') === '0' ? 'checked' : '' }}
                                class="w-5 h-5 rounded bg-[#1c2a5e] border-white/20 text-primary focus:ring-primary"/>
                            <label class="text-on-surface-variant" for="etimad-no">لا</label>
                        </div>
                    </div>
                </div>

                {{-- ارفاق السيرة الذاتية --}}
                <div class="flex flex-col items-center justify-center pt-4">
                    <label for="cv-upload"
                        class="flex items-center gap-2 bg-primary-container/80 hover:bg-primary-container text-white px-8 py-3 rounded-full cursor-pointer transition-all duration-300">
                        <input type="file" id="cv-upload" name="cv_path" accept=".pdf,.doc,.docx" class="hidden"
                            onchange="document.getElementById('cv-name').textContent = this.files[0]?.name ?? 'No file chosen'"/>
                        <span class="material-symbols-outlined text-sm">attach_file</span>
                        <span>ارفاق السيرة الذاتية *</span>
                    </label>
                    <span id="cv-name" class="text-[10px] text-slate-400 mt-2">No file chosen</span>
                </div>

                {{-- ارفق ملف الأعمال --}}
                <div class="flex flex-col items-center justify-center">
                    <label for="portfolio-upload"
                        class="flex items-center gap-2 bg-primary-container/80 hover:bg-primary-container text-white px-8 py-3 rounded-full cursor-pointer transition-all duration-300">
                        <input type="file" id="portfolio-upload" name="portfolio_path" accept=".pdf,.doc,.docx,.zip" class="hidden"
                            onchange="document.getElementById('portfolio-name').textContent = this.files[0]?.name ?? 'No file chosen'"/>
                        <span class="material-symbols-outlined text-sm">folder_open</span>
                        <span>ارفق ملف الأعمال</span>
                    </label>
                    <span id="portfolio-name" class="text-[10px] text-slate-400 mt-2">No file chosen</span>
                </div>

                {{-- زر الإرسال --}}
                <button type="submit"
                    class="w-full bg-primary-container hover:bg-opacity-90 text-white py-4 rounded-full font-headline-md transition-all duration-300 shadow-lg mt-4">
                    تقديم الطلب
                </button>

            </form>
        </div>

        {{-- معلومات التواصل --}}
        <div class="text-center mt-16 space-y-4">
            <h3 class="font-bold text-white text-xl">للاستفسارات والمعلومات</h3>
            <p class="text-on-surface-variant">م. رامي حسن - قسم تطوير الاعمال</p>
            <div class="flex flex-col items-center gap-2">
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
</main>
@endsection
