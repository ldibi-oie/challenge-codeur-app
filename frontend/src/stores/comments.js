import {getToken} from './usersFunction'
import requestApi from "../axios"

const createComment = async (comment) => {
    var token = await getToken();
    const r = [];
      (await requestApi
        .post("/api/comments", comment)
        .then((res) => {
          console.log("rescomment", res)
          r.push(res);
        }));
  
    return r;
};

export {
    createComment
}