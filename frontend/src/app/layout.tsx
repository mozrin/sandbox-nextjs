import React from "react";
import Top from "~/components/ui/Top/Top";
import Bottom from "~/components/ui/Bottom/Bottom";
import "../styles/global.css"; // Import global CSS

export const metadata = {
  title: "My App",
  description: "A description of my app",
};

interface RootLayoutProps {
  children: React.ReactNode;
}

export default function RootLayout({ children }: RootLayoutProps) {
  return (
    <html lang="en">
      <body>
        <Top />
        {children}
        <Bottom />
      </body>
    </html>
  );
}
