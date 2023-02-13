import requestApi from "../axios";
import { popUpError, popUpSuccess } from './notyf';

export const addCV = async (file) => {
    var r;
    await requestApi.post("/api/media_objects/" , file , {
        headers : {
            "Content-Type" : "multipart/form-data",
        }
    })
    .then(async () => {
        popUpSuccess('Vos donnees ont ete enregistré !')
        await getUser()
        r = true
    }).catch((err ) => {
        popUpError(err.message)
        r = false
    })

    return r;
}