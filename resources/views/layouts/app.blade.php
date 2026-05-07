<!DOCTYPE html>
<html class="dark" dir="rtl" lang="ar">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'نموذج التوظيف - NHBS')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary":                    "#bac3ff",
                        "secondary":                  "#bac3ff",
                        "on-primary":                 "#08218a",
                        "on-secondary":               "#0c2482",
                        "primary-container":          "#3f51b5",
                        "secondary-container":        "#2d409c",
                        "on-primary-container":       "#cacfff",
                        "on-secondary-container":     "#a7b4ff",
                        "surface":                    "#121319",
                        "surface-variant":            "#34343b",
                        "surface-container":          "#1f1f26",
                        "surface-container-low":      "#1a1b22",
                        "surface-container-high":     "#292930",
                        "surface-container-highest":  "#34343b",
                        "surface-container-lowest":   "#0d0e14",
                        "surface-bright":             "#383940",
                        "surface-dim":                "#121319",
                        "on-surface":                 "#e3e1ea",
                        "on-surface-variant":         "#c5c5d4",
                        "background":                 "#121319",
                        "on-background":              "#e3e1ea",
                        "outline":                    "#8f909e",
                        "outline-variant":            "#454652",
                        "inverse-surface":            "#e3e1ea",
                        "inverse-on-surface":         "#2f3037",
                        "inverse-primary":            "#4355b9",
                        "surface-tint":               "#bac3ff",
                        "tertiary":                   "#ffb784",
                        "on-tertiary":                "#502500",
                        "tertiary-container":         "#8f4700",
                        "on-tertiary-container":      "#ffc7a2",
                        "error":                      "#ffb4ab",
                        "on-error":                   "#690005",
                        "error-container":            "#93000a",
                        "on-error-container":         "#ffdad6",
                    },
                    fontFamily: {
                        "body-lg":      ["IBM Plex Sans Arabic"],
                        "body-md":      ["IBM Plex Sans Arabic"],
                        "label-sm":     ["IBM Plex Sans Arabic"],
                        "label-md":     ["IBM Plex Sans Arabic"],
                        "headline-lg":  ["IBM Plex Sans Arabic"],
                        "headline-md":  ["IBM Plex Sans Arabic"],
                    },
                    spacing: {
                        "container-padding": "48px",
                        "stack-sm":  "12px",
                        "stack-md":  "24px",
                        "stack-lg":  "40px",
                        "gutter":    "24px",
                        "unit":      "8px",
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'IBM Plex Sans Arabic', sans-serif;
            background-color: #050b1e;
            color: #e3e1ea;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
        }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-[#050b1e]">

    {{-- Fixed Header --}}
    <header class="fixed top-0 w-full z-50 border-b border-white/10 bg-[#050b1e]">
        <div class="flex justify-between items-center h-20 px-8 w-full max-w-screen-2xl mx-auto">
            <div class="flex items-center">
                <a href="https://nhbs.sa/" target="_blank" rel="noopener noreferrer">
                    <img alt="NHBS Logo" class="h-12 w-auto object-contain"
                         src="{{ asset('images/nhbs-logo.png') }}"/>
                </a>
            </div>
            <nav class="hidden md:flex gap-8">
                <a class="text-white font-bold border-b-2 border-primary pb-1 transition-all duration-300" href="#">التوظيف</a>
                <a class="text-slate-400 font-medium hover:text-primary transition-all duration-300" href="https://nhbs.sa/" target="_blank" rel="noopener noreferrer">عن الشركة</a>
            </nav>
        </div>
    </header>

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="border-t border-white/10 py-12 bg-[#050b1e]">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-12 max-w-7xl mx-auto">
            <div class="flex flex-col items-start">
                <div class="mb-4">
                    <img alt="NHBS Logo" class="h-10 w-auto object-contain"
                         src="{{ asset('images/nhbs-logo.png') }}"/>
                </div>
                <p class="text-slate-500 text-xs uppercase tracking-widest leading-relaxed"></p>
            </div>
            <div class="flex flex-col md:items-end gap-4">
                <p class="text-slate-500 text-xs uppercase tracking-widest">© 2024 NHBS. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
