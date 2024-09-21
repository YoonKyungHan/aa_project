@storybook([
    'args' => [
        'label' => 'Button',
        'type' => 'primary',
    ]
])
 
<x-button.primary
    :type="$type ?? null"
    :label="$label ?? null"
>
    {{ $label ?? null }}
</x-button.primary>