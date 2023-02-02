
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
      localStorage.setItem("user" , res.data.user)

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

export const getUser = async () => {
    var id = JSON.parse(localStorage.getItem("user")).id
    var token = JSON.parse(localStorage.getItem("user")).token
    console.log(id , token)
    try {
        requestApi.post("/api/users/" + id , {
        } , {
            headers: "Bearer " + token
        })
        .then((res) => {
        return res
        })
        .catch(err => {
            this.error = err
        })
    } catch(err) {
        return err.message
    }
}

export const logout = () => {
    localStorage.removeItem("token")
}