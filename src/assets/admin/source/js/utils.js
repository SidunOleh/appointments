import {Modal} from 'ant-design-vue'

const errorHandler = err => {
    const data = err.response.data
    if (data?.data?.message) {
        Modal.error({
            title: 'Error',
            content: data.data.message,
        })
    } else {
        Modal.error({
            title: 'Error',
            content: 'Something goes wrong.',
        })
    }
}

const dateStr = (year, month, day) => {
    return `${year}-${String(month+1).padStart(2, 0)}-${String(day).padStart(2, 0)}`
}

export {
    errorHandler,
    dateStr,
}