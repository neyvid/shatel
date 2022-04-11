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

export function persianCharachter(text) {
    return v => /^[ض ص ث ق ف غ ع ه خ ح ج چ پ گ ک م ن ت ا ل ب ی س ش ظ ط ز ر ذد ئ و ژي آ\s]+$/.test(v) || ` ${text}  معتبر نیست(نام باید به فارسی وارد شود) `

}

export function codeCheck(v) {
    if (v == null) {
        return 'وارد نمودن کد ملی الزامی می باشد.'
    }
    const control_code_number = v.substr(9, 1);
    let s = 0;
    if (!/^[0-9]{10}$/.test(v)) {
        return `کد ملی باید عدد و به تعداد 10 رقم باشد.`;
    }
    for (let i = 0; i < 9; i++) {
        s += parseInt(v.substr(i, 1), 10) * (10 - i);
    }
    let baghimande = s % 11;
    let control_number = 0;
    if (baghimande < 2) {
        control_number = baghimande;
    } else {
        control_number = 11 - baghimande
    }
    if (control_code_number != control_number) {
        return 'کد ملی وارد شده معتبر نمی باشد'
    }
}
