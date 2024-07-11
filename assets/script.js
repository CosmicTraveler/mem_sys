function ShowSuccessToastMessasge(message, duration) {

    iziToast.show({
        title: message,
        backgroundColor: 'lightgreen',
        timeout: duration,
        position: 'bottomRight',
    });
}

function ShowErrorToastMessasge(message) {

    let timeoutval = 1500;

    iziToast.show({
        title: message,
        backgroundColor: 'lightpink',
        timeout: timeoutval,
        position: 'bottomRight',
    });
}

function RegisterSuccess() {

    let timeoutval = 1500;

    iziToast.show({
        title: 'ทำการสมัครสมาชิกเสร็จสิ้น',
        backgroundColor: 'lightgreen',
        timeout: timeoutval,
        position: 'topLeft',
    });
}

function RegisterFail(message) {

    let timeoutval = 1500;

    iziToast.show({
        title: 'ผิดพลาด',
        message: message,
        backgroundColor: 'lightpink',
        timeout: timeoutval,
        position: 'topLeft',
    });
}

function generalSuccess(message) {

    let timeoutval = 1500;

    iziToast.show({
        title: 'สำเร็จ',
        message: message,
        backgroundColor: 'lightgreen',
        timeout: timeoutval,
        position: 'topLeft',
    });
}

function generalError(message) {

    let timeoutval = 1500;

    iziToast.show({
        title: 'ผิดพลาด',
        message: message,
        backgroundColor: 'gray',
        timeout: timeoutval,
        position: 'topLeft',
    });
}

function unverifySecurity(){

    let timeoutval = 2500;

    iziToast.show({
        title: 'ระบบความปลอดภัย',
        message: 'เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ',
        backgroundColor: 'red',
        timeout: timeoutval,
        position: 'topLeft',
    });
}

function generalSuccess3(message) {

    let timeoutval = 3000;

    iziToast.show({
        title: 'สำเร็จ',
        message: message,
        backgroundColor: 'lightgreen',
        timeout: timeoutval,
        position: 'topRight',
    });
}