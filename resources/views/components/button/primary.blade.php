<?php
/**
 * @blast
 *
 * @prop string $href The URL the button should link to
 * @prop string $icon The icon to display on the button
 * @prop string $iconPosition The position of the icon (before or after the label)
 * @prop string $label The text to display on the button
 *
 * @example <x-button.primary href="#" icon="menu-24" iconPosition="after" label="Click me" />
 */
?>
@php
    $typeClass = [
        'primary' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
        'secondary' => 'inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150',
        'danger' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-offset-2 transition ease-in-out duration-150',
    ];

    // 전달된 클래스에서 기본 클래스를 분리
    $allClasses = explode(' ', $attributes->get('class'));
    $baseClass = $typeClass[$allClasses[0] ?? 'primary'];
    $additionalClasses = implode(' ', array_slice($allClasses, 1));
    $classes = trim($baseClass . ' ' . $additionalClasses);
@endphp

<button type="{{$type ?? 'button'}}" class="{{ $classes }}" icon="menu-24">
    {{ $slot ?? null }}
</button>