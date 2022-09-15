import {computed, ref, watch} from "vue";
import useDebounce from "@/components/helper/debounce/useDebounce";
import price_formatter from "@/mixins/price_formatter";
// import price_formatter from "@/mixins/price_formatter";
// import remove_space from "@/mixins/remove_space";
// import price_formatter from "@/mixins/price_formatter";

export default function (props, emits) {
    const _value = ref(props.initialValue || props.modelValue);
    const value = computed({
        get: () => {
            return price_formatter(_value.value);
        },
        // eslint-disable-next-line no-unused-vars
        set: (newVal) => {
            const removed = newVal.replace(/[^0-9.]/gi, '');
            _value.value = parseFloat(removed) || 0;
            checkChanges(_value.value);
        }
    });
    const {debounce} = useDebounce();
    watch(() => props.modelValue, (val) => {
        _value.value = val;
    });

    function checkAndSendValue() {
        if (props.max < _value.value)
            _value.value = parseFloat(props.max.toFixed(2));
        else if (props.min > _value.value)
            _value.value = parseFloat(props.min.toFixed(2));
        emitModel();
    }

    watch(_value, function () {
        emitModel()
    });

    function emitModel() {
        emits('update:modelValue', _value.value);
    }

    watch(() => props.max, () => {
        checkAndSendValue();
    });
    watch(() => props.min, () => {
        checkAndSendValue();
    });

    // eslint-disable-next-line no-unused-vars
    function checkChanges(val) {
        if (parseFloat(props.max.toFixed(2)) < val || parseFloat(props.min.toFixed(2)) > val)
            debounce(checkAndSendValue, 600);
        else
            emitModel();
    }

    return {
        value: value,
        _value: _value,
        ...props
    }
}