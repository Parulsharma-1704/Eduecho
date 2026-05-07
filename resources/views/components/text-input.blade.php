@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-slate-200 dark:border-slate-700 dark:bg-slate-900/50 dark:text-slate-300 focus:border-cheerful-purple dark:focus:border-cheerful-purple focus:ring-cheerful-purple dark:focus:ring-cheerful-purple rounded-2xl shadow-sm px-5 py-3 transition-all duration-200 bg-slate-50/50']) }}>
