/* eslint-disable no-prototype-builtins */
import requestApi from "../axios";

export const getLoggedUser = () => {
  return JSON.parse(localStorage.getItem("user"));
};

export const getToken = () => {
  return JSON.parse(localStorage.getItem("token"));
};

export const getUser = async () => {
  console.log("chercher user en cours ...");

  var id = JSON.parse(localStorage.getItem("user"))?.id;
  var token = localStorage.getItem("token");
  console.log(id, token);

  const r = [];
  await requestApi
    .get("/api/users/" + id, {
      headers: "Bearer " + token,
    })
    .then((res) => {
      localStorage.setItem("user", JSON.stringify(res.data));
      r.push(res.data);
    });

  return r;
};

export const login = (state) => {
  state.isLoading = true;
  requestApi
    .post("/api/login_check", {
      username: state.username,
      password: state.password,
    })
    .then((res) => {
      console.log(res.data);
      state.token = res.data.token;
      // get user full object
      localStorage.setItem("token", res.data.token);
      localStorage.setItem("user", JSON.stringify(res.data.user));
      getUser(res.data.user?.id);

      if (res.data.user?.isVerified === false) {
        state.$router.push({ name: "waiting" });
      } else {
        state.$router.push({ name: "profile" });
      }
    })
    .catch((err) => {
      state.error = err;
    });
};

export const register = (state) => {
  var data = { email: state.email, password: state.password };
  state.isLoading = true;
  requestApi
    .post("/api/users", data)
    .then((res) => {
      sendVerificationEmail(res.data);
      // get user full object
      localStorage.setItem("user", JSON.stringify(res.data));
    })
    .catch((err) => {
      state.error = err;
    });
};

export const sendVerificationEmail = (data) => {
  requestApi
    .post("/register", data)
    .then((res) => {
      // this.token = res.data.token
      console.log(res);
      if (res) {
        var currentUrl = window.location.href;
        var newUrl = currentUrl.replace(/\/[^/]+$/, "/verify/waiting");
        window.location.href = newUrl;
      }
    })
    .catch((err) => {
      this.error = err;
    });
};

export const ResendVerificationEmail = async (data) => {
  var r = "";
  await requestApi.post("/register", data);

  return r;
};

export const getCategories = async () => {
  console.log("dzfeeefefefefef");
  var r = [];
  await requestApi.get("/api/categories").then((categories) => {
    const response = categories.data["hydra:member"];
    console.log(response);
    r.push(...response);
  });
  return r;
};

export const getOffers = async () => {
  console.log("cherche offes en cours -------------");
  var r = [];
  await requestApi.get("/api/offers").then((categories) => {
    const response = categories.data["hydra:member"];
    console.log(response);
    r.push(...response);
  });
  return r;
};

export const logout = async () => {
  localStorage.removeItem("token");
  localStorage.removeItem("user");
  localStorage.clear();
  window.location.href = "/";
  return false;
};

export const isFreelance = (data) => {
  let user = data || JSON.parse(localStorage.getItem("user"));
  return user && user.roles?.includes("ROLE_FREELANCER");
};

export const isCompany = (data) => {
  let user = data || JSON.parse(localStorage.getItem("user"));
  return user && user.roles?.includes("ROLE_COMPANY");
};

export const isRegisteredUser = (data) => {
  let user = data || JSON.parse(localStorage.getItem("user"));
  return (
    (user && user.roles?.includes("ROLE_FREELANCER")) ||
    (user && user.roles?.includes("ROLE_COMPANY"))
  );
};

export const getActiveSubscription = (user) => {
  for (const subscription of user.subscriptions || []) {
    if (subscription.isActive === true) {
      localStorage.setItem("active_sub", subscription);
      return subscription;
    }
  }
  localStorage.setItem("active_sub", null);
  return null;
};

export const getSubscriptionPlanText = (user, planId) => {
  const active_sub = getActiveSubscription(user);
  console.log("active_sub", active_sub);
  let text = "Get Started";
  if (active_sub) {
    text = "Change Plan";
    if (planId === active_sub.plan.stripeId) {
      text = "Current Plan";
    }
  }
  return text;
};
