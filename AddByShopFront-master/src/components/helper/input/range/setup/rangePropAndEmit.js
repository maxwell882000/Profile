
export default {
    props: {
        disableInput: {
            type: Boolean,
            default: false,
        },
        modelValue: {
            default: 0
        },
        turnOff: {
            type: Boolean
        },
        labelMin: {},
        labelMax: {},
        min: {
            default: 0
        },
        max: {
            default: 100
        },
    },
    emits: ['range-change', 'update:modelValue']
}