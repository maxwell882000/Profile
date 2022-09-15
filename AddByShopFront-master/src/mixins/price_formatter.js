export default function (price) {

    if (price) {
        let object = {
            integer: price,
            remainder: ""
        };
        if (typeof price === "number") {
            isNumber(object);
        } else {
            isString(object);
        }
        return object.integer.toString()
            .split("").reverse().join("") // this required to reverse the string , so our first digit will stand alone
            .match(/.{1,3}/g).join(" ") // split each 3 character, and join so the result 213 123 3
            .split("").reverse().join("") + object.remainder; // again reverse , and it is ready
    }

    function isNumber(object) {
        const remainder_int = price % 1;
        const whole_part = price - remainder_int;
        object.integer = whole_part.toString()
        if (remainder_int !== 0)
            object.remainder = remainder_int.toFixed(2).slice(1);
    }

    function isString(object) {
        if (price.length < 4) {
            object.integer = price;
            object.remainder = ""
        } else {
            const dot_index = price.length - 3;
            const has_remainder = price[dot_index] === ".";
            object.integer = price.slice(0, dot_index);
            object.remainder = has_remainder ? price.slice(dot_index) : "";
        }

    }

    return price;
}