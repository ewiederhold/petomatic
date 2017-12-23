console.log("got to reactFile.js");
// import React from 'react';
// import ReactDOM from 'react-dom';
// import Lightbox from 'react-images';

// ReactDOM.render(
//   <h1>Sherlock Holmes</h1>,
//   document.body
// );
<Lightbox
  images={[
    { src: '/images/usmSunset.jpg' },
  ]}
  isOpen={this.state.lightboxIsOpen}
  onClickPrev={this.gotoPrevLightboxImage}
  onClickNext={this.gotoNextLightboxImage}
  onClose={this.closeLightbox}
/>
