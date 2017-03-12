// <![CDATA[
var _ttprofiles = _ttprofiles || [];
_ttprofiles.profiles = [];
_ttprofiles.push(['_enableServices']);
document.write("<scr" + "ipt src='" + ("https:" == document.location.protocol ? "https:" : "http:") + "//d.tailtarget.com/profiles.js'></scr" + "ipt>");
// ]]>


/* TailTarget */
function sasAddData(data, m, o) {
    if (m instanceof Array) {
        for (var k = 0; k < m.length; k++) {
            if (!isNaN(m[k]) && Number(m[k]) !== 0) {
                data.push(o + "=" + m[k])
            }
        }
    } else if (!isNaN(m)) {
        data.push(o + "=" + m)
    }
}


function sasGetTT() {
    if (typeof (_ttprofiles) === "undefined") {
        return "";
    }
    var g = _ttprofiles,
        data = [];
    var d = Number(g.getAge),
        b = Number(g.getGender),
        c = g.getProfiles,
        a = g.getSubjects,
        u = g.getMicrosegments,
        j = Number(g.getEquipment),
        h = g.getTeam;

    if (!isNaN(d) && d !== 0) {
        data.push("tga=" + d)
    }
    if (!isNaN(b) && b !== 0) {
        data.push("tgg=" + b)
    }

    sasAddData(data, c, "tgp");
    sasAddData(data, a, "tgs");
    sasAddData(data, h, "tgt");
    sasAddData(data, u, "tgu");
    sasAddData(data, j, "tge");

    return data.join(";");
}