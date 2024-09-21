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

<!-- Start of Selection -->
<button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
<!-- End of Selection -->
    {{ $label }}
</button>