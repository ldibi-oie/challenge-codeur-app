/* eslint-disable no-prototype-builtins */
import requestApi from "../axios";
import storage from "./storage";

import { popUpError, popUpInfo } from '../stores/notyf'
export const getLoggedUser = async () => {
  return storage.getItem("user");
};

export const getToken = async () => {
  return storage.getItem("token");
};

export const getUser = async (useId) => {
  console.log("chercher user en cours ...");

  var token = await getToken();
  const id = useId || (await getLoggedUser())?.id;
  console.log("logged", id, token);

  const r = [];
  id &&
    (await requestApi
      .get("/api/users/" + id, {
        headers: "Bearer " + token,
      })
      .then((res) => {
        storage.setItem("user", res.data);
        r.push(res.data);
      }));

  return r;
};

export const login = (state) => {
  state.isLoading = true;
  requestApi
    .post("/api/login_check", {
      username: state.username,
      password: state.password,
    })
    .then(async (res) => {
      state.token = res.data.token;
      // get user full object
      await storage.setItem("token", res.data.token);
      await getUser(res.data.user?.id).then((result) => {

        // 
        console.log(result)
        const role = isCompany(res.data.user) || isFreelance(res.data.user)
        console.log(role)
        if (res.data.user?.isVerified === false) {
          state.$router.push({ name: "waiting" });
        } 
        if(!role) {
          state.$router.push({ name: "verify_user" });
        } else {
          state.$router.push({ name: "profile" });
        }
      })

      
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
    .then(async (res) => {
      sendVerificationEmail(res.data);
      // get user full object
      await storage.setItem("user", res.data);
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

export const sendResetPassword = async (email) => {
    var r;
    await requestApi.get("/api/users?email=" + email).then((res) => {
        console.log(res)
        const data = res.data["hydra:member"]
        if(data.length === 0 ){
            popUpError('Cette email n\'existe pas !')
            r = false
        } else {
            requestApi.post("/send/reset/password" , {id: data[0].id , email})
            .then((res) => {
                // this.token = res.data.token
                console.log(res)
                if(res){
                    popUpInfo('Un email a ete envoye a ' + email)
                    r = true;
                }
            })
            .catch(err => {
                this.error = err
                r = err.message
            }) 
        }
           
    })    
    return r;
}

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
  await storage.removeItem("token");
  await storage.removeItem("user");
  //await storage.clear();
  window.location.href = "/";
  return false;
};

export const isFreelance = (data) => {
  let user = data || getLoggedUser();
  return user && user?.roles?.includes("ROLE_FREELANCER");
};

export const isCompany = (data) => {
  let user = data || getLoggedUser();
  return user && user?.roles?.includes("ROLE_COMPANY");
};

export const isRegisteredUser = (data) => {
  let user = data || getLoggedUser();
  console.log("userhere", user)
  return (
    (user && user?.roles?.includes("ROLE_FREELANCER")) ||
    (user && user?.roles?.includes("ROLE_COMPANY"))
  );
};

export const getActiveSubscription = async (user) => {
  for (const subscription of user?.subscriptions || []) {
    if (subscription?.isActive === true) {
      await storage.setItem("active_sub", subscription);
      return subscription;
    }
  }
  await storage.setItem("active_sub", null);
  return null;
};

export const getSubscriptionPlanText = async (user, planId) => {
  const active_sub = await getActiveSubscription(user);
  console.log("active_sub", active_sub);
  let text = "Get Started";
  if (active_sub) {
    text = "Change Plan";
    if (planId === active_sub?.plan?.stripeId) {
      text = "Current Plan";
    }
  }
  return text;
};

export const getRapidApiOptions = (query) => {
  return {
    method: 'GET',
    url: 'https://jsearch.p.rapidapi.com/search',
    params: {query: query, num_pages: '1'},
    headers: {
      'X-RapidAPI-Key': import.meta.env.VITE_RAPID_API_KEY,
      'X-RapidAPI-Host': 'jsearch.p.rapidapi.com'
    }
  };
}


// get offer candidates by offer id
export const getOffersCandidatesByOfferId = async (options) => {
  const {
    offer_id= "",
    page= 1
  } = options
  var token = await getToken();
  const offers = await requestApi.get(`/api/freelances?page=${page}&offers=${offer_id}`, {
    headers: "Bearer " + token,
  });
  return offers.data["hydra:member"];
};

//get offers comments by offer id
export const getOffersCommentsByOfferId = async (options) => {
  const {
    offer_id= "",
    page= 1
  } = options
  var token = await getToken();
  const offers = await requestApi.get(`/api/comments?page=${page}&offer=${offer_id}`, {
    headers: "Bearer " + token,
  });
  return offers.data["hydra:member"];
}

export const addCandidate = async (selectedCandidate) => {
  console.log("adding candidate for" , selectedCandidate)
  await requestApi.patch("/api/offers/" + selectedCandidate.id , selectedCandidate.selectedCandidate , {
    headers : {
        "Content-Type" : "application/merge-patch+json",
    }
  })
  .then(() => {
    popUpSuccess('Siret soumis !')
    r = true
  })
  .catch((err) => {
    popUpError(err)
    r = false
  })
}
