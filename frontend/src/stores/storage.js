const storage = {
  async getItem(key) {
    try {
      return JSON.parse(localStorage.getItem(key));
    } catch (e) {
      console.error(e);
      return null;
    }
  },
  async setItem(key, data) {
    try {
      localStorage.setItem(key, JSON.stringify(data));
    } catch (e) {
      console.error(e);
    }
  },
  async removeItem(key) {
    try {
      localStorage.removeItem(key);
    } catch (e) {
      console.error(e);
    }
  },
};

export default storage;
