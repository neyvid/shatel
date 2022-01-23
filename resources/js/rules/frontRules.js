export function required(text) {
    return v => !!v || `وارد نمودن ${text} الزامی می باشد.`;
}


export function moreThan(field, length) {
    return v => (v ? v.length >= length : false) || `${field} باید بیشتر از ${length} کاراکتر باشد.`
}
