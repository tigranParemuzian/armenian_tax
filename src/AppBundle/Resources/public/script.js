// JavaScript Document

/* ՈՒՇԱԴՐՈՒԹՅՈՒՆ
 Այս սկրիպտի հեղինակը Արտակ Հարությունյանն է (Harutyunyan.Artak[at]gmail.com)։ Բացառիկ իրավունքները պատկանում են www.akumb.am-ին։ Առանց http://hayeren.akumb.am-ին հղում անելու և հեղինակային իրավունքի մասին այս գրառումը պահպանելու, այս սկրիպտն օգտագործել չի թույլատրվում: Սկրիպտի մեջ սխալներ գտնելու կամ կատարելագործելու դեպքում խնդրում ենք տեղեկացնել։ */

inOneCharLetters = "ABGDEZILXKHMYNOPJSVWTRCQFabgdez@ilx$kh&mynopjsvwtrcqf?";
outOneCharLetters = "ԱԲԳԴԵԶԻԼԽԿՀՄՅՆՈՊՋՍՎՎՏՐՑՔՖաբգդեզըիլխծկհճմյնոպջսվվտրցքֆ՞";
inTwoCharLetters = "YEYeE'EEEeY'@@THThZHZhJHJhKHKhC'TSTsD'DZDzGHGhTWTw&&SHShVOVoCHChR'RRRrP'PHPhO'OOOoyee'eey'thzhjhkhc'tsd'dzghtwshvochr'rrp'phevo'oo";
outTwoCharLetters = "ԵԵԷԷԷԸԸԹԹԺԺԺԺԽԽԾԾԾՁՁՁՂՂՃՃՃՇՇՈՈՉՉՌՌՌՓՓՓՕՕՕեէէըթժժխծծձձղճշոչռռփփևօօ";
inThreeCharLetters = "Uu";
outThreeCharLetters = "Ուու";

function translit(inString)
{
    var inStringLength = inString.length;
    var outString = "";

    for (i = 0; i < inStringLength; i++)
    {
        is2char = false;
        if (i < inStringLength - 1) {
            for(j = 0; j < outTwoCharLetters.length; j++)
            {
                if(inString.substr(i, 2) == inTwoCharLetters.substr(j*2,2)) {
                    outString += outTwoCharLetters.substr(j, 1);
                    i++;
                    is2char=true;
                    break;
                }
            }
        }

        if(!is2char) {
            var currentCharacter = inString.substr(i, 1);

            var pos = inThreeCharLetters.indexOf(currentCharacter);
            if (pos < 0)
            {
                var pos = inOneCharLetters.indexOf(currentCharacter);

                if (pos < 0)
                    outString += currentCharacter;
                else
                    outString += outOneCharLetters.substr(pos, 1);
            }
            else
                outString += outThreeCharLetters.substr(pos*2, 2);
        }
    }
    return outString;
}


armsciiLetters = "²´¶¸º¼¾ÀÂÄÆÈÊÌÎÐÒÔÖØÚÜÞàâäæèêìîðòôöøúü³µ·•¹»½¿ÁÃÅÇÉËÍÏÑÓÕ×ÙÛÝßáãåçéëíïñóõ÷ù¨ûý";
unicodeLetters = "ԱԲԳԴԵԶԷԸԹԺԻԼԽԾԿՀՁՂՃՄՅՆՇՈՉՊՋՌՍՎՏՐՑՒՓՔՕՖաբգգդեզէըթժիլխծկհձղճմյնշոչպջռսվտրցւփքևօֆ";

function armscii2unicode(inString)
{
    var inStringLength = inString.length;
    var outString = "";

    for (i = 0; i < inStringLength; i++)
    {
        var currentCharacter = inString.substr(i, 1);
        var pos = armsciiLetters.indexOf(currentCharacter);
        if (pos < 0)
            outString += currentCharacter;
        else
            outString += unicodeLetters.substr(pos, 1);
    }

    return outString;
}

function unicode2armscii(inString)
{
    var inStringLength = inString.length;
    var outString = "";

    for (i = 0; i < inStringLength; i++)
    {
        var currentCharacter = inString.substr(i, 1);
        var pos = unicodeLetters.indexOf(currentCharacter);
        if (pos < 0)
            outString += currentCharacter;
        else
            outString += armsciiLetters.substr(pos, 1);
    }

    return outString;
}

function toLowercase(inString)
{
    var inStringLength = inString.length;
    var outString = "";

    for (i = 0; i < inStringLength; i++)
    {
        var currentCharacter = inString.substr(i, 1);
        outString += currentCharacter.toLowerCase();
    }

    return outString;
}

function toUppercase(inString)
{
    var inStringLength = inString.length;
    var outString = "";

    for (i = 0; i < inStringLength; i++)
    {
        var currentCharacter = inString.substr(i, 1);
        if (currentCharacter == "և")
            outString += "ԵՎ";
        else
            outString += currentCharacter.toUpperCase();
    }

    return outString;
}

function toFirstLetter(inString)
{
    var inStringLength = inString.length;
    var outString = "";

    for (i = 0; i < inStringLength; i++)
    {
        var currentCharacter = inString.substr(i, 1);
        if (i == 0 || inString.substr(i-1, 1) == " " ||  inString.substr(i-1, 1) == ":" || inString.substr(i-1, 1) == ".") {
            if (currentCharacter == "և")
                outString += "ԵՎ";
            else
                outString += currentCharacter.toUpperCase();
        }
        else {
            outString += currentCharacter.toLowerCase();
        }
    }

    return outString;
}

function toEntity(inString)
{
    var inStringLength = inString.length;
    var outString = "";
    for (i = 0; i < inStringLength; i++)
    {
        outString += "&#" + inString.charCodeAt(i) + ";";
    }
    return outString;
}

function fromEntity(inString)
{
    var inStringLength = inString.length;
    var outString = "";

    for (i = 0; i < inStringLength; i++)
    {
        var isEntity = false;
        if (inString.substr(i,2) == "&#")
        {
            for (j = 1; j <= 4; j++) {
                if (inString.substr(i+2+j,1) == ";") {
                    var temp = inString.substr(i+2,j);
                    temp = Math.ceil(temp);
                    if (!isNaN(temp)) {
                        outString += String.fromCharCode(temp);
                        i += 2 + j;
                        isEntity = true;
                    }
                    break
                }
            }
        }
        if (!isEntity)
        {
            outString += inString.substr(i,1);
        }

    }
    return outString;
}

function convert(inString)
{
    outString = "";
    switch (document.getElementById('convertType').value)
    {
        case "translit":
            outString = translit(inString);
            break;
        case "armscii2unicode":
            outString = armscii2unicode(inString);
            break;
        case "unicode2armscii":
            outString = unicode2armscii(inString);
            break;
        case "entity":
            outString = toEntity(inString);
            break;
        case "fromEntity":
            outString = fromEntity(inString);
            break;
        case "uppercase":
            outString = toUppercase(inString);
            break;
        case "lowercase":
            outString = toLowercase(inString);
            break;
        case "firstLetter":
            outString = toFirstLetter(inString);
            break;
    }
    return outString;
}

function editorFont(editor1ID, editor2ID)
{
    switch (document.getElementById('convertType').value)
    {
        case "armscii2unicode":
            document.getElementById(editor1ID).className = "stEditorArmscii";
            document.getElementById(editor2ID).className = "stEditor";
            break;
        case "unicode2armscii":
            document.getElementById(editor1ID).className = "stEditor";
            document.getElementById(editor2ID).className = "stEditorArmscii";
            break;
        default:
            document.getElementById(editor1ID).className = "stEditor";
            document.getElementById(editor2ID).className = "stEditor";
            break;
    }
}