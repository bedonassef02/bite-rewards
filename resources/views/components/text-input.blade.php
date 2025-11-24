@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 focus:border-brand focus:ring-brand rounded-xl shadow-sm']) }}>
