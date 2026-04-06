<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Taskflow') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* MANTENEMOS LOS ESTILOS ORIGINALES DE LARAVEL AQUÍ PARA QUE NO SE ROMPA NADA */
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
            @layer theme {

                :root,
                :host {
                    --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                    --font-serif: ui-serif, Georgia, Cambria, "Times New Roman", Times, serif;
                    --font-mono: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                    --color-black: #000;
                    --color-white: #fff;
                    --spacing: .25rem;
                    --text-sm: .875rem;
                    --text-base: 1rem;
                    --text-lg: 1.125rem;
                    --text-xl: 1.25rem;
                    --text-2xl: 1.5rem;
                    --text-3xl: 1.875rem;
                    --text-4xl: 2.25rem;
                    --font-weight-normal: 400;
                    --font-weight-medium: 500;
                    --font-weight-bold: 700;
                    --radius-sm: .25rem;
                    --radius-lg: .5rem;
                    --default-transition-duration: .15s;
                    --default-transition-timing-function: cubic-bezier(.4, 0, .2, 1);
                    --default-font-family: var(--font-sans);
                }
            }

            @layer base {

                *,
                :after,
                :before,
                ::backdrop {
                    box-sizing: border-box;
                    border: 0 solid;
                    margin: 0;
                    padding: 0
                }

                html,
                :host {
                    -webkit-text-size-adjust: 100%;
                    -moz-tab-size: 4;
                    tab-size: 4;
                    line-height: 1.5;
                    font-family: var(--default-font-family, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji");
                    -webkit-tap-highlight-color: transparent
                }

                body {
                    line-height: inherit
                }

                a {
                    color: inherit;
                    -webkit-text-decoration: inherit;
                    text-decoration: inherit
                }

                h1,
                h2,
                h3,
                h4,
                h5,
                h6 {
                    font-size: inherit;
                    font-weight: inherit
                }
            }

            @layer utilities {
                .absolute {
                    position: absolute
                }

                .relative {
                    position: relative
                }

                .flex {
                    display: flex
                }

                .hidden {
                    display: none
                }

                .inline-block {
                    display: inline-block
                }

                .h-14\.5 {
                    height: calc(var(--spacing)*14.5)
                }

                .min-h-screen {
                    min-height: 100vh
                }

                .w-full {
                    width: 100%
                }

                .max-w-\[335px\] {
                    max-width: 335px
                }

                .max-w-4xl {
                    max-width: 56rem
                }

                .flex-col {
                    flex-direction: column
                }

                .items-center {
                    align-items: center
                }

                .justify-center {
                    justify-content: center
                }

                .justify-end {
                    justify-content: flex-end
                }

                .gap-4 {
                    gap: calc(var(--spacing)*4)
                }

                .rounded-sm {
                    border-radius: var(--radius-sm)
                }

                .border {
                    border-style: solid;
                    border-width: 1px
                }

                .border-\[\#19140035\] {
                    border-color: #19140035
                }

                .border-transparent {
                    border-color: #0000
                }

                .bg-\[\#FDFDFC\] {
                    background-color: #fdfdfc
                }

                .p-6 {
                    padding: calc(var(--spacing)*6)
                }

                .px-5 {
                    padding-inline: calc(var(--spacing)*5)
                }

                .py-1\.5 {
                    padding-block: calc(var(--spacing)*1.5)
                }

                .mb-2 {
                    margin-bottom: calc(var(--spacing)*2)
                }

                .mb-6 {
                    margin-bottom: calc(var(--spacing)*6)
                }

                .text-sm {
                    font-size: var(--text-sm)
                }

                .text-lg {
                    font-size: var(--text-lg)
                }

                .text-4xl {
                    font-size: var(--text-4xl)
                }

                .font-medium {
                    font-weight: var(--font-weight-medium)
                }

                .font-bold {
                    font-weight: var(--font-weight-bold)
                }

                .text-\[\#1b1b18\] {
                    color: #1b1b18
                }

                .text-\[\#706f6c\] {
                    color: #706f6c
                }

                .leading-normal {
                    line-height: 1.5
                }

                .opacity-100 {
                    opacity: 1
                }

                .transition-opacity {
                    transition-property: opacity;
                    transition-timing-function: var(--default-transition-timing-function);
                    transition-duration: var(--default-transition-duration)
                }

                .duration-750 {
                    transition-duration: .75s
                }

                .not-has-\[nav\]\:hidden:not(:has(:is(nav))) {
                    display: none
                }

                @media (hover:hover) {
                    .hover\:border-\[\#1915014a\]:hover {
                        border-color: #1915014a
                    }
                }

                @media (width>=64rem) {
                    .lg\:block {
                        display: block
                    }

                    .lg\:max-w-4xl {
                        max-width: 56rem
                    }

                    .lg\:grow {
                        flex-grow: 1
                    }

                    .lg\:justify-center {
                        justify-content: center
                    }

                    .lg\:p-8 {
                        padding: calc(var(--spacing)*8)
                    }
                }

                @media (prefers-color-scheme:dark) {
                    .dark\:border-\[\#3E3E3A\] {
                        border-color: #3e3e3a
                    }

                    .dark\:bg-\[\#0a0a0a\] {
                        background-color: #0a0a0a
                    }

                    .dark\:text-\[\#EDEDEC\] {
                        color: #ededec
                    }

                    .dark\:text-\[\#A1A09A\] {
                        color: #a1a09a
                    }

                    @media (hover:hover) {
                        .dark\:hover\:border-\[\#3E3E3A\]:hover {
                            border-color: #3e3e3a
                        }

                        .dark\:hover\:border-\[\#62605b\]:hover {
                            border-color: #62605b
                        }
                    }
                }

                @starting-style {
                    .starting\:opacity-0 {
                        opacity: 0
                    }
                }
            }
        </style>
    @endif
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Inicio
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Iniciar Sesión
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Registrate
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="flex w-full flex-col items-center justify-center text-center">

            <h1 class="text-4xl lg:text-5xl font-bold mb-4 text-[#1b1b18] dark:text-[#EDEDEC]">
                Bienvenido a Taskflow
            </h1>

            <p class="text-lg text-[#706f6c] dark:text-[#A1A09A]">
                Regístrate o inicia sesión para comenzar