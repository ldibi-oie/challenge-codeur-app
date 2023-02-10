
import requestApi from '../axios';

export const login = (data) => {
    requestApi.post("/api/login_check" , {
        username: data.username,
        password: data.password
    })
    .then((res) => {
      console.log(res.data)
      // this.$router.push('/profile');
      localStorage.setItem("token" , res.data.token)
      localStorage.setItem("user" , JSON.stringify(res.data.user))

    //   if(res.data.user.isVerified === false){
    //     this.$router.push('/verify/waiting/');
    //   } else {
    //     this.$router.push('/profile');
    //   }

    })
    .catch(err => {
        console.log(err)
    })
}

export const register = (email , password) => {
    var data = {email , password}
    requestApi.post("/api/users" , data)
      .then((res) => {
          // this.token = res.data.token
          sendVerificationEmail(res.data)
          localStorage.setItem("user" , JSON.stringify(res.data))
      })
      .catch(err => {
          this.error = err
      })
}

export const sendVerificationEmail = (data) => {
    requestApi.post("/register" , data)
      .then((res) => {
          // this.token = res.data.token
          console.log(res)
          if(res){
            var currentUrl = window.location.href;
            var newUrl = currentUrl.replace(/\/[^\/]+$/, '/verify/waiting');
            window.location.href = newUrl;
          }
      })
      .catch(err => {
          this.error = err
      })
}

export const ResendVerificationEmail = async (data) => {
    var r = ''
    await requestApi.post("/register" , data)

    return r;
}

export const getUser = async () => {
    console.log("chercher user en cours ...")

    var id = JSON.parse(localStorage.getItem("user")).id
    var token = localStorage.getItem("token")
    // console.log(id , token)
    var r = [];

    await requestApi.get("/api/users/" + id , {
        headers: "Bearer " + token
    }).then((res) => {
        r.push(res.data)
    })
    
    return r;
}

export const getCategories = async () => {
    console.log("dzfeeefefefefef")
    var r = [];
    await requestApi.get("/api/categories").then((categories) => {
        const response = categories.data["hydra:member"]
        console.log(response)
        r.push(...response)   
    })
    return r;
}



export const logout = async () => {
    localStorage.removeItem("token")
    localStorage.removeItem("user")
    localStorage.clear()
    var currentUrl = window.location.href;
    var newUrl = currentUrl.replace(/\/[^\/]+$/ , '');
    window.location.href = newUrl;
    return false;
}
