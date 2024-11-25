"use client";

import { redirect } from "next/navigation";
import { useEffect } from "react";

export default function NotFound() {
  useEffect(() => {
    // Log the invalid path access
    fetch("http://backend.dev.docker/api/log-invalid-path", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-API-TOKEN": "7e5a9120d9e641b2ae3765b9f6c98421",
      },
      body: JSON.stringify({
        path: window.location.pathname,
        timestamp: new Date().toISOString(),
      }),
    });

    // Redirect to the home page
    redirect("/");
  }, []);

  return null;
}
