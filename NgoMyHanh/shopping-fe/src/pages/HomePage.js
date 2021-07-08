import Product from "../components/Product";
const HomePage = () => {
    return (
        <div className="container">
        <div className="row">
          <div className="col-2">
            xinchao
          </div>
          <div class="col-10">
              <div className="row">
                    <div className="col">
                       <Product></Product>
                    </div>
                    <div className="col">
                        <Product></Product>
                    </div>
                    <div className="col">
                        <Product></Product>
                    </div>
                    <div className="col">
                        <Product></Product>
                    </div>
              </div>
          </div>
        </div>
      </div>
    );
  };
  export default HomePage;
  