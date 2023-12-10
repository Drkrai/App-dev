import { useToast } from 'vue-toast-notification';

export function showNotification(message, type = 'success') {
  const toast = useToast();
  toast[type](message, {
    position: 'top',
    duration: 3000,
    dismissible: true,
  });
}
