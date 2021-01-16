import moment from 'moment'

export default (date) => {
    if (!date) return '-'
    try {
        moment.locale('pt_br');
        return moment(date).format("DD/MM/YYYY");
    } catch (e) {
        return date
    }
}