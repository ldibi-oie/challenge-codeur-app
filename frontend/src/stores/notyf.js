import { Notyf } from 'notyf';

const notification = new Notyf({
    duration: 1000,
    position: {
      x: 'center',
      y: 'bottom',
    }
  });

export const popUpSuccess = (message) => {
    return notification.success(message)
}

export const popUpError = (message) => {
    return notification.error(message)
}

export const popUpInfo = (message) => {
    return notification.open(message)
}