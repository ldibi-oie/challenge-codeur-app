const upload = Upload({ apiKey: "free" })

export const addFile = async (event) => {
    const [ file ]    = event.target.files;
    const { fileUrl } = await upload.uploadFile(
        file,
        {
        onBegin:    ({ cancel })   => console.log("File upload started!"),
        onProgress: ({ progress }) => console.log(`File uploading... ${progress}%`)
        }
    );
    console.log(`File uploaded! ${fileUrl}`);
    
}