import { createStore } from 'vuex';

export default createStore({
  state: {
    notifications: [],
  },
  mutations: {
    addNotification(state, notification) {
      state.notifications.push(notification);
    },
    clearNotifications(state) {
      state.notifications = [];
    },
  },
});
