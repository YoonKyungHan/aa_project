@storybook([
    'args' => [
        'slot' => 'Button',
        'class' => 'primary',
    ],
    'argTypes' => [
        'class' => [
            'control' => 'select',
            'options' => [
                'primary' => 'primary',
                'secondary' => 'secondary',
                'danger' => 'danger',
            ],
        ],
    ]
])

<x-button.primary
    :class="$class ?? 'primary'"
    type="submit"
    >
    {{ $slot ?? 'test' }}
</x-button.primary>