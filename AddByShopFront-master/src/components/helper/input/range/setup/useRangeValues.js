import {computed, ref, watch} from "vue";

export default function (props) {
    const index = ref(props.initialValue >= 0 ? props.initialValue : 0);
    const sliderValues = computed({
        get: () => {
            return index.value;
        },
        set: (val) => {
            index.value = val;

        }
    });
    // reset input
    watch(() => props.reset, () => {
        index.value = 0;
    })

    const input = computed({
        get: () => {
            try {
                return props.values[index.value];
            } catch (e) {
                return 0;
            }
        },
        set: () => {
            console.log("IS SETTED");
        }
    })
    return {
        sliderValues: sliderValues,
        inputValue: input
    }
}