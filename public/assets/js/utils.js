function format_money(n, d = 1) {
    let x = ('' + n).length -1, p = Math.pow;
    d = p(10, d);
    x -= x % 3
    return Math.round(n * d / p(10, x)) / d + " kMBTPE"[x / 3]
}

function convertToSlug(text) {
    text = text.toLowerCase();
    const from = "áàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ";
    const to = "aaaaaaaaaaaaaaaaadeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyy";
    for (let i = 0, length = from.length; i < length; i++) {
        const char = from[i];
        const pattern = new RegExp(char, "g");
        text = text.replace(pattern, to[i]);
    }
    text = text.replace(/\s+/g, "-");
    return text;
}

const numb = function (number, options = {} ) {
    const config = {
        prefix:'',
        suffix:'',
        thous:'.',
        dec:3,
        ...options,
    }
    const {prefix,suffix,thous,dec} = config;
    let number_only = ('' + number).replace(/\D/g, '');
    let pattern = '(\\d)(?=(';
    for (let i = 0; i < dec; i++) {
        pattern += '\\d';
    }
    pattern += ')+(?!\\d))';
    let regex = new RegExp(pattern, 'g')
    return prefix + number_only.replace(regex, "$1" + thous) + suffix;
};

const handleCopy = (content) => {
    navigator.clipboard.writeText(content)
        .then(() => {
            //coppy xong thì làm gì đó ở đây;
        })
}

function formatDate(date) {
    let d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear(),
        hours = d.getHours(),
        minutes = d.getMinutes();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return `${year}-${month}-${day}  ${hours}:${minutes}`;
}
