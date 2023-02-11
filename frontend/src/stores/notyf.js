import { Notyf } from 'notyf';
import 'notyf/notyf.min.css'; 

const notification = new Notyf({
    duration: 10000,
    position: {
      x: 'center',
      y: 'bottom',
    },
    types: [
      {
        type: 'info',
        background: 'blue',
        icon: false
      }
    ]
  });

export const popUpSuccess = (message) => {
    return notification.success(message)
}

export const popUpError = (message) => {
    return notification.error(message)
}

export const popUpInfo = (message) => {
    return notification.open({
      type: 'info',
      message
    });
}