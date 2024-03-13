import Typewriter from "typewriter-effect"

interface TypewriterProps {
    strings: string[],
    autostart?: boolean,
    loop?: boolean
}

export default function HeaderTitle ({
    strings,
    autostart = true,
    loop = true
} : TypewriterProps) {
  return (
    <Typewriter
      options={{
        strings: strings,
        autoStart: autostart,
        loop: loop,
      }}
    />
  );
}
