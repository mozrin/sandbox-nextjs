import type { AppProps } from "next/app";

import Top from "../components/ui/Top/Top";
import Bottom from "../components/ui/Bottom/Bottom";

import "../styles/global.css";

function MyApp({ Component, pageProps }: AppProps) {
  return (
    <div>
      <Top />
      <Component {...pageProps} />
      <Bottom />
    </div>
  );
}

export default MyApp;
