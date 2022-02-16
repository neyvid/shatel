export function required(text) {
    return v => !!v || `وارد نمودن ${text} الزامی می باشد.`;
}


export function moreThan(field, length) {
    return v => (v ? v.length >= length : false) || `${field} باید بیشتر از ${length} کاراکتر باشد.`
}

export function code() {
    return v => /^0[0-9][0-9]$/.test(v) || 'کد شهر معتبر نمیباشد(کد شهر سه رقمی و با صفر شروع می شود)'
    return v => /^[ض ص ث ق ف غ ع ه خ ح ج چ پ گ ک م ن ت ا ل ب ی س ش ظ ط ز ر ذد ئ و ژي آ\s]+$/.test(v) || 'کد شهر معتبر نمیباشد(کد شهر سه رقمی و با صفر شروع می شود)'
}

export function persianCharachter() {
    return v => /^[ض ص ث ق ف غ ع ه خ ح ج چ پ گ ک م ن ت ا ل ب ی س ش ظ ط ز ر ذد ئ و ژي آ\s]+$/.test(v) || 'نام شهر معتبر نیست(نام باید به فارسی وارد شود)'

}
