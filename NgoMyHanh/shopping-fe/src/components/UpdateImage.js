import React,{useState} from 'react';
import ImageUploading from 'react-images-uploading';

const UpdateImage = ({setFile}) => {
    const [images, setImages] = useState([]);
    const maxNumber = 1;
    const onChange = (imageList, addUpdateIndex) => {
      console.log("CHOOSE IMAGE");

        const formData = new FormData();
        setImages(imageList);
      
        formData.append(
            "file",
            imageList[0].file,
        );   

        setFile(imageList[0].file);
      };

      return (
              <ImageUploading
                multiple
                value={images}
                onChange={onChange}
                maxNumber={maxNumber}
                dataURLKey="data_url"
              >
                {({
                  imageList,
                  onImageUpload,
                  onImageUpdate,
                  isDragging,
                  dragProps,
                }) => (
                  <div className="upload__image-wrapper">
                    {imageList<1 && <button
                      style={isDragging ? { color: 'red' } : undefined}
                      onClick={onImageUpload}
                      {...dragProps}
                    >
                      Upload
                    </button> }
                    
                    &nbsp;
                    {imageList.map((image, index) => (
                      <div key={index} className="image-item">
                        <img src={image['data_url']} alt="" width="100" />
                        <div className="image-item__btn-wrapper">
                          <button onClick={() => onImageUpdate(index)}>Update</button>
                        </div>
                      </div>
                    ))}
                  </div>
                )}
              </ImageUploading>
              
          );
}

export default UpdateImage;


